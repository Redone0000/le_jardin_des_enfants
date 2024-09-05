<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <form id="payment-form">
        <input type="number" name="amount" placeholder="Amount" required>
        <div id="card-element"></div>
        <button type="submit">Pay</button>
    </form>

    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();

        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createPaymentMethod('card', card).then(function(result) {
                if (result.error) {
                    console.error(result.error.message);
                } else {
                    fetch('{{ route('payment.process') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            payment_method_id: result.paymentMethod.id,
                            amount: form.querySelector('input[name="amount"]').value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Payment successful!');
                        } else {
                            console.error(data.error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
