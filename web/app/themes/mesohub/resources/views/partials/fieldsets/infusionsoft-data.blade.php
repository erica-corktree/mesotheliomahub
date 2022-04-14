<input name="infFormType"     type="hidden" value="orderForm">
<input name="infProductName"  type="hidden" x-model="productName">
<input name="infPaymentType"  type="hidden" x-model="paymentType">
<input name="infProductId"    type="hidden" x-model.number="productId">
<input name="infProductPrice" type="hidden" x-model.number="subtotal">
<input name="infShippingName" type="hidden" x-model="shippingDesc">
<input name="infShippingRate" type="hidden" x-model.number="shippingRate">
<input name="infTimeZone"     type="hidden" x-model="timeZone">
<input name="infOrderTotal"   type="hidden" :value="subtotal + shippingRate">
<input name="infVersion"      type="hidden" value="1.70.0.281349">
