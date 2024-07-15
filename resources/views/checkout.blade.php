@use('Eminisolomon\SafeHaven\SafeHaven')
<div>

    <button {{ $attributes }}
            onclick="payWithSafeHaven()"
    >
        {{ $buttonText }}
    </button>

    <script src="https://checkout.safehavenmfb.com/assets/checkout.min.js"></script>
    <script type="text/javascript">
        const payWithSafeHaven = () => {
            SafeHavenCheckout({
                environment: "{{ SafeHaven::config('environment') }}", //sandbox || production
                clientId: "{{ SafeHaven::config('client_id') }}",

                referenceCode: ''+Math.floor((Math.random() * 1000000000) + 1),
                currency: "NGN", // Must be NGN
                amount: @json($amount),

                customer: @json($customer),
                settlementAccount: @json($settlementAccount),

                redirectUrl: @json($redirectUrl),
                webhookUrl: "{{ $webhookUrl }}",

                customIconUrl: "{{ $customIconUrl ?? 'https://safehavenmfb.com/assets/images/logo1.svg' }}",
                 metadata: @json($metadata),

                onClose: () => {
                    document.dispatchEvent(new CustomEvent('safeHavenCheckoutClosed'));
                    fetch('{{ route('safehaven::checkout-close') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                },
                callback: (response) => {
                    document.dispatchEvent(new CustomEvent('safeHavenCheckoutCallback', { detail: response }));
                    fetch('{{ route('safehaven::checkout-callback') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(response)
                    })
                        .then(response => response.json())

                 }

            });
        }
    </script>


</div>
