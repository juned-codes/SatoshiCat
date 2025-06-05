<?php

// Microwallets Data - Be careful when editing this array
$microwallets = [
    
    // https://faucetpay.io/page/api-documentation
    'faucetpay' => [
        'name' => 'FaucetPay',
        'currencies' => ['BCH','BNB','BTC','DASH','DGB','DOGE','ETH','FEY','LTC','TRX','USDT','ZEC'],
        'api_base' => 'https://faucetpay.io/api/v1/',
        'check' => 'https://faucetpay.io/page/user-admin',
        'url' => 'https://gr8.cc/goto/faucetpay'
    ],
    
];

// Currency List
$currencies = [
	'ADA' 	=> 'Cardano',
    'BCH' 	=> 'Bitcoin Cash',
    'BCN' 	=> 'Bytecoin',
    'BNB' 	=> 'Binance Coin',
    'BTC' 	=> 'Bitcoin',
    'BTT' 	=> 'BitTorrent',
    'DASH' 	=> 'Dash',
    'DGB' 	=> 'DigiByte',
    'DOGE' 	=> 'Dogecoin',
    'EOS' 	=> 'Eos',
    'ETC' 	=> 'Ethereum Classic',
    'ETH' 	=> 'Ethereum',
    'EXG' 	=> 'EX Gold',
    'EXS' 	=> 'EX Silver',
	'FEY'	=> 'Feyorra',
	'KMD'	=> 'Komodo',
    'LSK' 	=> 'Lisk',
    'LTC' 	=> 'Litecoin',
    'NEO' 	=> 'Neo',
	'PIVX' 	=> 'Pivx',
    'PPC' 	=> 'Peercoin',
    'QTUM' 	=> 'Qtum',
	'RDD' 	=> 'Reddcoin',
	'RVN'   => 'Ravencoin',
    'STRAX' => 'Stratis',
    'TRX' 	=> 'Tron',
	'USDT'	=> 'Tether',
	'VTC'	=> 'Vertcoin',
    'WAVES' => 'Waves',
    'XMR' 	=> 'Monero',
    'XPM' 	=> 'Primecoin',
    'XRP' 	=> 'Ripple',
	'XTZ' 	=> 'Tezos',
    'ZEC' 	=> 'Zcash',
	'ZEN'	=> 'Horizen'
];
