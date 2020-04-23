<a href="{{ route('fine_scales_view', ['id' => $query->id]) }}" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white">
                      <i class="fas fa-flag"></i>
                    </span>
    <span class="text">view</span>
</a>
<a href="{{ route('fine_scales_edit', ['id' => $query->id]) }}" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white">
                      <i class="fas fa-info-circle"></i>
                    </span>
    <span class="text">edit</span>
</a>

<button id="deleteBtn" type="button" data-id="{{ $query->id }}" class="btn btn-danger btn-icon-split btn-sm">
        <span class="icon text-white">
          <i class="fas fas fa-trash"></i>
        </span>
    <span class="text">Delete</span>
</button>
