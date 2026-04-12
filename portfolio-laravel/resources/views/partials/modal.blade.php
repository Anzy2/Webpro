<div class="modal-overlay" id="projectModal">
  <div class="modal-backdrop" id="modalBackdrop"></div>
  <div class="modal-box" id="modalBox">
    <button class="modal-close" id="modalClose">
      <i data-feather="x"></i>
    </button>
    <div id="modalContent">{{-- diisi oleh JavaScript --}}</div>
  </div>
</div>

{{-- Data proyek untuk modal (JSON di-encode aman oleh Blade) --}}
@push('scripts')
<script>
  window.projectData = {!! json_encode(
    collect($projects)->keyBy('id')->map(fn($p) => [
      'emoji'     => $p['emoji'],
      'title'     => $p['title'],
      'category'  => $p['cat_label'],
      'year'      => $p['year'],
      'color'     => $p['color'],
      'accent'    => $p['accent'],
      'desc'      => $p['desc'],
      'longDesc'  => $p['desc'], // ganti dengan field long_desc jika ada
      'tags'      => $p['tags'],
    ]),
    JSON_UNESCAPED_UNICODE
  ) !!};
</script>
@endpush
