<?php

require_once('vendor/autoload.php');

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Address\AddressCreator;
use BitWasp\Bitcoin\Key\Deterministic\HdPrefix\GlobalPrefixConfig;
use BitWasp\Bitcoin\Key\Deterministic\HdPrefix\NetworkConfig;
use BitWasp\Bitcoin\Network\Slip132\BitcoinRegistry;
use BitWasp\Bitcoin\Key\Deterministic\Slip132\Slip132;
use BitWasp\Bitcoin\Key\KeyToScript\KeyToScriptHelper;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeySequence;
use BitWasp\Bitcoin\Key\Deterministic\MultisigHD;
use BitWasp\Bitcoin\Network\NetworkFactory;
use BitWasp\Bitcoin\Serializer\Key\HierarchicalKey\Base58ExtendedKeySerializer;
use BitWasp\Bitcoin\Serializer\Key\HierarchicalKey\ExtendedKeySerializer;

class HD {
  private $network = NULL;
  private $xpub = NULL;
  private $ypub = NULL;
  private $zpub = NULL;
  private $multisig_xpubs = NULL;

  public function __construct($network = 'bitcoin') {
    if (version_compare(PHP_VERSION, '5.3') >= 0) {
      $this->network = NetworkFactory::$network();
    } elseif (version_compare(PHP_VERSION, '5.2.3') >= 0) {
      $this->network = call_user_func("NetworkFactory::$network");
    } else {
      $this->network = call_user_func('NetworkFactory', $network);
    }
  }

  public function set_xpub($xpub) {
    $this->xpub = $xpub;
  }

  public function set_ypub($ypub) {
    $this->ypub = $ypub;
  }

  public function set_zpub($zpub) {
    $this->zpub = $zpub;
  }

  public function set_multisig_xpubs($xpubs) {
    $this->multisig_xpubs = $xpubs;
  }

  public function address_from_master_pub($path = '0/0') {
    if ($this->xpub === NULL && $this->ypub === NULL && $this->zpub === NULL) {
      throw new Exception("XPUB, YPUB or ZPUB key is not present!");
    }

    $adapter = Bitcoin::getEcAdapter();
    $slip132 = new Slip132(new KeyToScriptHelper($adapter));
    $bitcoin_prefixes = new BitcoinRegistry();

    if ($this->xpub !== NULL) {
      $pubPrefix = $slip132->p2pkh($bitcoin_prefixes);
      $pub = $this->xpub;
    } else if ($this->ypub !== NULL) {
      $pubPrefix = $slip132->p2shP2wpkh($bitcoin_prefixes);
      $pub = $this->ypub;
    } else if ($this->zpub !== NULL) {
      $pubPrefix = $slip132->p2wpkh($bitcoin_prefixes);
      $pub = $this->zpub;
    }

    $config = new GlobalPrefixConfig([
      new NetworkConfig($this->network, [
        $pubPrefix,
      ])
    ]);

    $serializer = new Base58ExtendedKeySerializer(
      new ExtendedKeySerializer($adapter, $config)
    );

    $key = $serializer->parse($this->network, $pub);
    $child_key = $key->derivePath($path);

    return $child_key->getAddress(new AddressCreator())->getAddress();
  }

  public function multisig_address_from_xpub($m, $path = '0/0') {
    if (count($this->multisig_xpubs) < 2) {
      throw new Exception("XPUB keys are not present!");
    }

    $keys = array();

    foreach ($this->multisig_xpubs as $xpub) {
      $keys[] = HierarchicalKeyFactory::fromExtended($xpub, $this->network);
    }

    $sequences = new HierarchicalKeySequence();
    $hd = new MultisigHD($m, 'm', $keys, $sequences, TRUE);

    $child_key = $hd->derivePath($path);

    return $child_key->getAddress()->getAddress($this->network);
  }
}