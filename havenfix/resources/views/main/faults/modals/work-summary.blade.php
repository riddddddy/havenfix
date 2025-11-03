<!-- Modal -->
<div class="modal fade" id="work-summary-modal-{{ $fault->id }}" tabindex="-1"
    aria-labelledby="work-summary-modal-label-{{ $fault->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Work Summary Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>{{ $fault->item }}</h6>
                <table class="table table-bordered table-striped my-3">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Remarks</th>
                            <th>Date</th>
                            <th>Reported By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fault->workSummaries as $index => $summary)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $summary->remarks }}</td>
                                <td>{{ $summary->created_at->format('d M Y') }}</td>
                                <td>{{ $summary->user->first_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
