<div class="mb-3">
    <label for="type" class="form-label">Type</label>
    <select name="type" id="type" class="form-control" required>
        <option value="Terms&Condition" {{ old('type', $content->type ?? '') == 'Terms&Condition' ? 'selected' : '' }}>Terms & Condition</option>
        <option value="Privacy" {{ old('type', $content->type ?? '') == 'Privacy' ? 'selected' : '' }}>Privacy</option>
    </select>
</div>

<div class="mb-3">
    <label for="locale" class="form-label">Language</label>
    <select name="locale" id="locale" class="form-control" required>
        <option value="en" {{ old('locale', $content->locale ?? '') == 'en' ? 'selected' : '' }}>English</option>
        <option value="es" {{ old('locale', $content->locale ?? '') == 'es' ? 'selected' : '' }}>Spanish</option>
    </select>
</div>

<div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $content->content ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-success">Save</button>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>