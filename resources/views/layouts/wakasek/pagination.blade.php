@push('css')
    <style>
        .custom-pagination {
            display: flex;
            gap: 0.375rem;
            justify-content: flex-end;
            align-items: center;
        }

        .custom-pagination a,
        .custom-pagination span {
            background-color: #ffffff;
            border: 1px solid #3b82f6;
            color: #3b82f6;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            line-height: 1rem;
        }

        .custom-pagination a:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }

        .custom-pagination .active {
            background-color: #3b82f6;
            color: #ffffff;
            border: 1px solid #3b82f6;
        }

        .custom-pagination .disabled {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            color: #d1d5db;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
@endpush


@if ($data->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-600">
            Menampilkan
            <span class="font-semibold">{{ $data->firstItem() }}</span>
            sampai
            <span class="font-semibold">{{ $data->lastItem() }}</span>
            dari total
            <span class="font-semibold">{{ $data->total() }}</span>
            data
        </div>

        <div class="custom-pagination">
            {{-- Tombol Previous --}}
            @if ($data->onFirstPage())
                <span class="disabled">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a href="{{ $data->previousPageUrl() }}" rel="prev">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            {{-- Nomor Halaman --}}
            @php
                $start = max(1, $data->currentPage() - 2);
                $end = min($data->lastPage(), $data->currentPage() + 2);
                $range = range($start, $end);
            @endphp

            {{-- Halaman Pertama + Ellipsis --}}
            @if ($start > 1)
                <a href="{{ $data->url(1) }}">1</a>
                @if ($start > 2)
                    <span>...</span>
                @endif
            @endif

            {{-- Halaman Aktif & Halaman Lainnya --}}
            @foreach ($range as $page)
                @if ($page == $data->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $data->url($page) }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Halaman Terakhir + Ellipsis --}}
            @if ($end < $data->lastPage())
                @if ($end < $data->lastPage() - 1)
                    <span>...</span>
                @endif
                <a href="{{ $data->url($data->lastPage()) }}">{{ $data->lastPage() }}</a>
            @endif

            {{-- Tombol Next --}}
            @if ($data->hasMorePages())
                <a href="{{ $data->nextPageUrl() }}" rel="next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="disabled">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>
@endif
