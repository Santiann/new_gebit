<?php namespace Dealix\Planos\Widgets;

use Backend\Classes\WidgetBase;

class ListTransactions extends WidgetBase
{
    /**
     * @var string A unique alias to identify this widget.
     */
    protected $defaultAlias = 'listTransactions';

    private $transactions;

    public function __construct($controller, $transactions)
    {
        parent::__construct($controller);
        $this->transactions = $transactions;
    }

    public function render()
    {
        return $this->makePartial('transactions', ['transactions' => $this->transactions]);
    }
}