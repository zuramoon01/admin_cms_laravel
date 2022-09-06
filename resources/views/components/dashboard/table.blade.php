@props(['title', 'tableProduct'])

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered"
                id="{{ isset($tableProduct) && !empty($tableProduct) ? $tableProduct : '' }}" width="100%"
                cellspacing="0">
                {{ $slot }}
            </table>
        </div>
    </div>
</div>
