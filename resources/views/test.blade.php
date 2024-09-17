<x-layout>

    <div class="container text-center">
        <div>
            <h1 class="text-2xl font-bold">Product: Mobile Phone </h1>
            <h1 class="text-2xl font-bold">Price: $10 </h1>

            <form action="{{ route('stripe') }}" method="post">
                @csrf
                <input type="hidden" value="Laptop" name="product_name">
                <input type="hidden" value="24" name="quantity">
                <input type="hidden" value="270" name="price">
                <button type="submit" class="bg-green-700 hover:bg-green-800 py-2 px-3 rounded-xl">Pay With
                    Stripe</button>
            </form>
        </div>
    </div>

</x-layout>
