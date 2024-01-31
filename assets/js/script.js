https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
const tokenizationSpecification={
	type: 'PAYMENT_GATEWAY',
	payments: {
		gateway:'example',
		gatewayMerchantId: 'gatewayMerchantId',
	}
};
const cardPaymentMethod={
	type: 'CARD',
	tokenizationSpecification: tokenizationSpecification,
	parameters:{
		allowedCardNetwork:['VISA','MASTERCARD',"AMEX", "DISCOVER", "INTERAC", "JCB"],
		allowedAuthMethods:['PAN ONLY','CRYPTOGRAM_3DS'],
	}
};
const googlePayConfiguration ={
	apiVersion:2,
	apiVersionMinor: 0,
	allowedPaymentMethods:[cardPaymentMethod],
};

const ballElement = document.querySelector("#ball1");

ballElement.addEventListener("click", function() {
    const ball1Element = document.querySelector("#ball1");
    ball1Element.classList.add("clicked");
});
let googlePayClient;
function onGooglePayLoaded(){
	googlePayClient=new googlePayClient.payments.api.PaymentClient({
		environment: 'TEST',
	});
	googlePayClient.isReadyToPay(googlePayConfiguration)
		.then(response=>{
			if(response.result){
				if (response.result){
					createAndAddButton();
				}else{
					//The user cannot pay with google Py suggest an alternative
				}
			}
		})
		.catch(error =>console.error('isReadyToPay error: ',error));
};
function createAndAddButton(){
	const googlePayButton = googlePayClient.createButton({
		onClick: onGooglePayButtonClicked,
	});
	document.getElementById('buy-now').appendChild(googlePayButton);
};

function onGooglePayButtonClicked(){
	const paymentDataRequest = { ...googlePayConfiguration};
	paymentDataRequest.merchantInfo={
		merchantId: 'BCR2DN4TZ3C47NTA',
		merchantName: 'Buckshour',
	}
	paymentDataRequest.transactionInfo={
		totalPriceStatus: 'FINAL',
		totalPrice: selectedItem.price,
		currencyCode:'USD',
		countryCode:'KE',
	};
	googlePayClient.loadPaymentData(paymentDataRequest)
		.then(paymentData => processPaymentData(paymentData))
		.catch(error => console.error('loadPaymentData error:',error ));
}
function processPaymentData(paymentData){
	fetch(orderEndpointUrl,{
		method: 'POST',
		headers: {
			'Content-Type':'application/json'

		},
		body: paymentData
	})
}