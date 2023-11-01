<div>
    <div class="row">
        <div class="col-8">
            <br>
            <h4 class="card-title">Məhsullar</h4>
            <table>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <thead>
                        <tr>
                            <th>Məhsul</th>
                            <th>Ölçü vahidi</th>
                            <th>Miqdarı</th>
                            <th>Qiymət</th>
                            <th>ƏDV dərəcəsi</th>
                            <th>Məbləğ</th>
                            <th>Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        <br>
                        <button wire:click.prevent="addProduct" class="btn btn-primary">+</button>
                        <br><br>
                        @foreach($orderProducts  as $index => $orderProduct)
                            <tr>
                                <td style="width: 25%">
                                    <select class="form-control"  type="text" wire:model="orderProducts.{{$index}}.product_id" name="orderProducts[{{$index}}][product_id]" id="corporate_name{{$index}}">
                                        <option selected>-----</option>
                                        @foreach($allProducts as $c)
                                            <option value="{{$c->id}}">{{$c->title}}</option>
                                        @endforeach
                                    </select>
                                </td >
                                <td style="width: 10%">
                                    <input class="form-control" type="text" name="orderProducts[{{$index}}][unit]" wire:model="orderProducts.{{$index}}.unit">
                                </td>
                                <td style="width: 10%">
                                    <input class="form-control" type="text" min="1" wire:change="getTotalAmount({{$index}})"  name="orderProducts[{{$index}}][measure]" wire:model="orderProducts.{{$index}}.measure">
                                </td>
                                <td style="width: 10%">
                                    <input class="form-control" type="text" min="1"  wire:change="getTotalAmount({{$index}})"  name="orderProducts[{{$index}}][price]" wire:model="orderProducts.{{$index}}.price">
                                </td>
                                <td style="width: 25%">
                                    <select class="form-control"  type="number"  wire:change="getTotalAmount({{$index}})" wire:model="orderProducts.{{$index}}.edv" name="orderProducts[{{$index}}][edv]" id="corporate_edv{{$index}}">
                                        <option selected>-----</option>
                                        <option value="0">ƏDV-siz</option>
                                        <option value="0.18">18%</option>
                                        <option value="0">0%</option>
                                    </select>
                                </td >
                                <td style="width: 10%">
                                    <input class="form-control" type="text" name="orderProducts[{{$index}}][total_amount]" wire:model="orderProducts.{{$index}}.total_amount" wire:key="{{ $this->getTotalAmount($index) }}">
                                </td>
                                <td style="width: 10%"><button type="submit" wire:click.prevent="removeProduct({{$index}})" class="btn btn-danger">-</button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="text-center mt-4">
                        <strong>Total Amount Sum: {{ number_format($totalAmountSum, 2) }}</strong>
                        <input type="hidden" name="common_price"  value="{{ number_format($totalAmountSum, 2) }}">
                    </div>
                </div>
            </table>
        </div>
    </div>
</div>

