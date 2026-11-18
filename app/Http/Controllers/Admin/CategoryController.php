<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $categories = Category::withCount('reports')->when($request->filled('search'), fn($q) => $q->where('name','like','%'.$request->search.'%'))->orderBy('name')->paginate(12)->withQueryString();
        return view('admin.categories.index', compact('categories'));
    }
    public function create() { return view('admin.categories.form', ['category' => new Category]); }
    public function store(Request $request) { $data=$request->validate(['name'=>['required','string','max:100','unique:categories,name'],'description'=>['nullable','string','max:500']]); Category::create($data); return redirect()->route('admin.categories.index')->with('success','Kategori berhasil ditambahkan.'); }
    public function edit(Category $category) { return view('admin.categories.form', compact('category')); }
    public function update(Request $request, Category $category) { $data=$request->validate(['name'=>['required','string','max:100',Rule::unique('categories')->ignore($category->id)],'description'=>['nullable','string','max:500']]); $category->update($data); return redirect()->route('admin.categories.index')->with('success','Kategori berhasil diperbarui.'); }
    public function destroy(Category $category) { if ($category->reports()->exists()) return back()->with('error','Kategori tidak dapat dihapus karena masih digunakan oleh laporan.'); $category->delete(); return back()->with('success','Kategori berhasil dihapus.'); }
}
