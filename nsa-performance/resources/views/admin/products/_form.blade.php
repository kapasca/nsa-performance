@csrf

<div class="mb-3">
  <label>Name</label>
  <input type="text" name="name" class="form-control"
    value="{{ old('name', $product->name ?? '') }}" required>
</div>

<div class="mb-3">
  <label>Price</label>
  <input type="number" name="price" class="form-control"
    value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
  <label>Discount Price</label>
  <input type="number" name="discount_price" class="form-control"
    value="{{ old('discount_price', $product->discount_price ?? '') }}">
</div>

<div class="mb-3">
  <label>Description</label>
  <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
  <label>Image</label>
  <input type="file" name="image" class="form-control">
</div>

<div class="form-check mb-3 mt-3">
  <input type="hidden" name="is_featured" value="0">
  <input type="checkbox"
    name="is_featured"
    value="1"
    class="form-check-input"
    {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
  <label class="form-check-label">Featured</label>
</div>

<div class="d-flex justify-content-start mt-5 gap-3">
  <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-3">Cancel</a>
  <button type="submit" class="btn btn-success px-3">Save</button>
</div>