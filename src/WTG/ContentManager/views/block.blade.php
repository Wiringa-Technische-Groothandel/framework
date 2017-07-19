<div id="block-{{ $block->getName() }}" {{ auth()->isAdmin() ? 'contenteditable="true" class="block editable"' : 'class="block"' }}>
    {{ $block->getContent() }}
</div>

@if (auth()->isAdmin())
    <script>
        var editor = CKEDITOR.inline('block-{{ $block->getName() }}');

        editor.on( 'change', function( evt ) {
            var data = evt.editor.getData();
            // getData() returns CKEditor's HTML content.
            console.log( 'Total bytes: ' + data.length );
        });
    </script>
@endif