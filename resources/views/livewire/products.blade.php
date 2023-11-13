<div>
    <div class="row">
        <div class="col-6">
            <br>
            <h4 class="card-title">Məhsullar</h4>
            <table>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <thead>
                        <tr>
                            <th>Məhsul</th>
                            <th>Miqdarı</th>
                            <th>Sil</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orderProducts  as $index => $orderProduct)
                            <tr>
                                <td style="width: 40%">
                                    <select class="form-control js-example-basic-single"  type="text" wire:model="orderProducts.{{$index}}.product_id" name="orderProducts[{{$index}}][product_id]" id="corporate_name_{{$index}}">
                                        <option selected disabled>-----</option>
                                        @foreach($allProducts as $c)
                                            <option value="{{$c->id}}">{{$c->title}}</option>
                                        @endforeach
                                    </select>
                                </td >
                                <td style="width: 40%">
                                    <input class="form-control" type="number" name="orderProducts[{{$index}}][measure]" wire:model="orderProducts.{{$index}}.measure">
                                </td>
                                <td style="width: 20%"><button type="submit" wire:click.prevent="removeProduct({{$index}})" class="btn btn-danger">-</button></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <br>
                    <button wire:click.prevent="addProduct" class="btn btn-primary">+</button>
                    <br><br>
                </div>
            </table>
        </div>
    </div>
</div>
