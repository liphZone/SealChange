<form method="post" action="https://payeer.com/merchant/">
    @csrf
    <input type="hidden" name="m_shop" value="{{ $id }}">
    <input type="hidden" name="m_orderid" value="{{ $reference }}">
    <input type="hidden" name="m_amount" value="{{ $montant }}">
    <input type="hidden" name="m_curr" value="{{ $devise_out }}">
    <input type="hidden" name="m_desc" value="{{ $description }}">
    <input type="hidden" name="m_sign" value="{{$payement_reference}}">
    <!--
    <input type="hidden" name="form[ps]" value="2609">
    <input type="hidden" name="form[curr[2609]]" value="USD">
    -->
    <!--
    <input type="hidden" name="m_params" value="">
    -->
    <input type="submit" name="m_process" value="Continuer" />
</form>
