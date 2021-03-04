<form method="GET" action="https://wallet.advcash.com/sci/">
    <input type="hidden" name="ac_account_email" value="hopesealchange@gmail.com">
    <input type="hidden" name="ac_sci_name" value="SealChange">
    <input type="hidden" name="ac_amount" value="{{ $montant }}">
    <input type="hidden" name="ac_currency" value="{{ $devise_out }}">
    <input type="hidden" name="ac_order_id" value="{{ $reference }}">
    <input type="hidden" name="ac_sign" value="{{ $reference }}">
    <input type="hidden" name="ac_comments" value="Payement">
    <!-- Merchant custom fields -->
    <input type="hidden" name="operation_id" value="{{ $id }}">
    <input type="hidden" name="login" value="denis">
    <input type="submit" value="Continuer">
</form> 