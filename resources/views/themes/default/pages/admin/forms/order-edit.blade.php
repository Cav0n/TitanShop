<form action="{{ route('admin.order.update', ['order' => $order]) }}" method="POST" class="row">
    @csrf

    <div class="form-group col-12">
        <label for="title">Numéro de suivi</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('trackingNumber', $order->trackingNumber) }}" disabled>
    </div>

    <div class="col-12 col-lg-4 mb-3 d-flex flex-column">
        <p class="h4">Client</p>

        @isset($order->user)
            <a href="{{ route('admin.user.edit', ['user' => $order->user]) }}">{{ $order->customerIdentity }}</a>
        @else
            <p>{{ $order->customerIdentity }}</p>
            <a href="mailto:{{ $order->mail }}">{{ $order->email }}</a>
            <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a>
        @endisset
    </div>

    <div class="col-12 col-lg-4 mb-3">
        <p class="h4">Adresse de livraison</p>
        <p>{!! $order->shippingAddress !!}</p>
    </div>

    <div class="col-12 col-lg-4">
        <p class="h4">Adresse de facturation</p>
        <p>{!! $order->billingAddress !!}</p>
    </div>

    <div class="row mx-0 w-100">
        <div class="col-12">
            <p class="h4 mb-2">
                Produits de la commande :
            </p>
            <table class="table border">
                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->productName }}</td>
                        <td class="text-center">{{ $item->priceFormatted }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">{{ $item->totalPriceFormatted }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td class="text-center"></td>
                        <td class="text-right">Total :</td>
                        <td class="text-right">{{ $order->totalPriceFormatted }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="text-center"></td>
                        <td class="text-right">Frais de ports :</td>
                        <td class="text-right">{{ $order->shippingCostsFormatted }}</td>
                    </tr>

                    <tr class="bg-light">
                        <td></td>
                        <td class="text-center"></td>
                        <td class="text-right"><b>Total avec frais de port:</b></td>
                        <td class="text-right"><b>{{ $order->totalPriceWithShippingCostsFormatted }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" name="lang" value="FR">

    <div class="form-group col-12 mb-0">
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </div>
</form>
