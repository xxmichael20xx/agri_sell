<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">{{ $title }}</h4>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="report--activity-logs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Report Generation
            </button>
            <div class="dropdown-menu">
                @include( 'admin.export.modal_trigger', $inc )
                @include( 'admin.export.months_trigger', $inc )
            </div>
        </div>
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
                            Amount
                        </th>
                        <th>
                            Payout #
                        </th>
                        @if ( $index == 1)
                            Reject Reason
                        @endif
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $data as $_index => $item )
                        <tr>
                            <td>
                                {{ $item->seller->name }}
                            </td>
                            <td>
                                ₱ {{ AppHelpers::numeric( $item->amount ) }}
                            </td>
                            <td>
                                Payout #{{ $item->id }}
                            </td>
                            @if ( $index == 1)
                                <td>
                                    {{ $item->reject_reason }}
                                </td>
                            @endif
                            <td>
                                <a href="/admin/payout/{{ $item->id }}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include( 'admin.export.modal_content', $inc )
@include( 'admin.export.months_modal', $inc )
