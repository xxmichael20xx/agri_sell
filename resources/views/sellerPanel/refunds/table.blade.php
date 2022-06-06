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
                        @if ( $index == '0' )
                            <th>
                                Confirmed Date
                            </th>
                        @endif
                        @if ( $index == '2' )
                            <th>
                                Request Date
                            </th>
                        @endif
                        <th>
                            Reason
                        </th>
                        @if ( $index == '1' )
                            <th>
                                Reject Reason
                            </th>
                        @endif
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $data as $index => $item )
                        <tr>
                            <td>
                                {{ $item->customer->name }}
                            </td>
                            <td id="refund--container-{{ $index }}" class="w-25">
                                @if ( count( $item->expl_images ) > 0  )
                                    <img src="/storage/{{ $item->expl_images[0] }}" class="img-fluid view-images w-50" data-id="refund--image-{{ $index }}" data-raw="{{ $index }}">

                                    <div class="modal fade" id="refund--image-{{ $index }}">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Refund: Proof images</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="refund--images">
                                                        @foreach ( $item->expl_images as $image)
                                                            <img src="/storage/{{ $image }}" class="img-fluid w-50">
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
                            @if ( $index == '0' )
                                <td>
                                    {{ AppHelpers::humanDate( $item->created_at, true ) }}
                                </td>
                            @endif
                            @if ( $index == '2' )
                                <td>
                                    {{ AppHelpers::humanDate( $item->updated_at, true ) }}
                                </td>
                            @endif
                            <td>
                                {{ $item->refund_reason_prod_txt }}
                            </td>
                            @if ( $index == '1' )
                                <td>
                                    {{ $item->reason }}
                                </td>
                            @endif
                            <td>
                                <a href="/sellerpanel/refunds/{{ $item->id }}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                                {{-- <button type="button" class="btn btn-primary" onclick="Swal.fire({ icon: 'info', title: 'On Development' })">More Info</button> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No results</td>
                            <td>No results</td>
                            <td>No results</td>
                            @if ( $index == '1' )
                                <td>No results</td>
                            @endif
                            <td>No results</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
