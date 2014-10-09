<?php

namespace Omnipay\Helcim;

/**
 * Helcim Server (direct) driver for Omnipay
 */
class DirectGateway extends AbstractCommonGateway
{
    /**
     * Constants the gateway needs or returns.
     */

    const CVV2_INDICATOR_PRESENT = '1';
    const CVV2_INDICATOR_NOT_VISIBLE = '2';
    const CVV2_INDICATOR_NOT_PRESENT = '3';
    const CVV2_INDICATOR_IGNORE = '4';

    // CHECKME: the CCV2 response codes should be (ought to be) in core Omnipay.
    // Similar for AVS responses.

    // M - Match.
    const CVV2_RESPONSE_MATCH = 'M';
    // N - No match.
    const CVV2_RESPONSE_NO_MATCH = 'N';
    // P - Not processed.
    const CVV2_RESPONSE_NOT_PROCESSED = 'P';
    // S - Issuer indicates CCV2 should be present, but merchant has not presetnted it.
    const CVV2_RESPONSE_NOT_PRESENTED = 'S';
    // Issuer not certified.
    const CVV2_RESPONSE_NOT_CERTIFIED = 'U';

    public function getName()
    {
        return 'Helcim Direct';
    }

    /**
     * The transaction date is only used when fetching a transaction from the API.
     */
    public function setTransactionDate($value)
    {
        return $this->setParameter('transactionDate', $value);
    }

    public function getTransactionDate()
    {
        return $this->getParameter('transactionDate');
    }

    /**
     * Search string when retrieving transactions from the history.
     */
    public function setSearch($value)
    {
        return $this->setParameter('search', $value);
    }

    public function getSearch()
    {
        return $this->getParameter('search');
    }

    /**
     * For handling a purchase.
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Helcim\Message\DirectPurchaseRequest', $parameters);
    }

    /**
    * For the return path from the remote Hosted Page.
    */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Helcim\Message\DirectCompleteRequest', $parameters);
    }

    /**
     * For handling an authorize action.
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Helcim\Message\DirectAuthorizeRequest', $parameters);
    }

    /**
    * For the return path from the remote Hosted Page.
    */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Helcim\Message\DirectCompleteRequest', $parameters);
    }

    /**
     * To fetch a single transaction.
     * Fetch by transactionId or orderId. Both will be unique.
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Helcim\Message\DirectFetchTransactionRequest', $parameters);
    }

    /**
     * To search through the past transaction history.
     */
    public function transactionHistory(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Helcim\Message\DirectTransactionHistoryRequest', $parameters);
    }
}
