<style>
	#pm{
		margin-top: 10em;
		margin-left: 30em;
	}
</style>

<div  id="pm" class="text-center">
	<form action="https://perfectmoney.is/api/step1.asp" method="POST">
		@csrf
		<input type="hidden" name="PAYEE_ACCOUNT" value="{{ $moncompte }}">
		<input type="hidden" name="PAYEE_NAME" value="{{ $payee_name }}">
		<input type="hidden" name="PAYMENT_AMOUNT" value="{{ $montant }}">
		<input type="hidden" name="PAYMENT_UNITS" value="{{ $devise_enter }}">
		<input type="hidden" name="PAYMENT_URL" value="http://hopesealchange.com/success.php">
		<input type="hidden" name="NOPAYMENT_URL" value="http://hopesealchange.com/fail.php">
		<input type="hidden" name="PAYMENT_ID" value="{{ $id_transaction }}">
		{{-- @if($STATUS_URL)
			<input type="hidden" name="STATUS_URL" value="{{ $STATUS_URL }}">
		@endif
		@if($PAYMENT_URL_METHOD)
			<input type="hidden" name="PAYMENT_URL_METHOD" value="{{ $PAYMENT_URL_METHOD }}">
		@endif
		@if( $NOPAYMENT_URL_METHOD )
			<input type="hidden" name="NOPAYMENT_URL_METHOD" value="{{ $NOPAYMENT_URL_METHOD }}">
		@endif
		
		@if( $MEMO )
			<input type="hidden" name="SUGGESTED_MEMO" value="{{ $MEMO }}">
		@endif --}}
		<button class="btn btn-secondary btn-lg" type="submit"> Cliquez pour continuer la transaction <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </button>
	</form>
</div>
