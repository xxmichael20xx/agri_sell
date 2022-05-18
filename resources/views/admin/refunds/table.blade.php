<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{ $title }}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="toolbar"></div>
            <table id="datatable{{ $index }}" class="table" cellspacing="0" width="100%">
                <thead class="text-primary">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Reason
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $data as $index => $item )
                        @php
                            $images = explode( ",", rtrim( $item->image_proofs, "," ) );
                        @endphp
                        <tr>
                            <td>
                                {{ $item->customer->name }}
                            </td>
                            <td id="refund--container-{{ $index }}">
                                @if ( count( $images ) > 0  )
                                    <img src="/storage/{{ $images[0] }}" class="img-fluid view-images" data-id="refund--image-{{ $index }}" data-raw="{{ $index }}">

                                    <div class="modal fade" id="refund--image-{{ $index }}">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Refund: Proof images</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="refund--images">
                                                        @foreach ( $images as $image)
                                                            <img src="/storage/{{ $image }}" class="img-fluid">
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    No image(s) provided
                                @endif
                            </td>
                            <td>
                                {{ $item->refund_reason_prod_txt }}
                            </td>
                            <td>
                                {{-- <a href="{{ $item->id }}" class="btn btn-sm btn-primary text-white m-1">More info</a> --}}
                                <button type="button" class="btn btn-primary" onclick="Swal.fire({ icon: 'info', title: 'On Development' })">More Info</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No results</td>
                            <td>No results</td>
                            <td>No results</td>
                            <td>No results</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
