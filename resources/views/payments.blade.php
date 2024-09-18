<x-layout>

    <div class="container text-center ">
        <div class="">
            <h1 class="text-2xl font-bold">Product: Laptop </h1>
            <h1 class="text-2xl font-bold">Price: $200 </h1>

            <form action="{{ route('stripe') }}" method="post">
                @csrf
                <input type="hidden" value="Laptop" name="product_name">
                <input type="hidden" value="1" name="quantity">
                <input type="hidden" value="200" name="price">
                <button type="submit" class="bg-green-700 hover:bg-green-800 py-2 px-3 rounded-xl">Pay With
                    Stripe</button>
            </form>

            <hr class="m-4  ">
            <form action="{{ route('paypal') }}" method="post">
                @csrf
                <input type="hidden" name="price" value="200">
                <input type="hidden" name="product_name" value="Laptop">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 py-2 px-3 rounded-xl">Pay With
                    Paypal</button>
            </form>
        </div>
    </div>

</x-layout>
