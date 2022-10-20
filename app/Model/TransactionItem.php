<?php
	class TransactionItem extends AppModel{
        public $belongsTo = array('Transaction');
		public $hasMany = array('TransactionItem');
	}