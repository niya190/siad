<?= $this->extend('layouts/staf_tailwind') ?>
<?= $this->section('content') ?>

<style>
    /* Custom Scrollbar untuk area form */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>

<div class="-mt-8 -mx-8 -mb-12 flex flex-col h-[calc(100vh-4.5rem)]">
    
    <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 shrink-0">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-bold text-slate-900">Batch Digitalization</h2>
            <div class="h-6 w-px bg-slate-200"></div>
            <div class="flex items-center gap-2">
                <div class="w-32 h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="bg-primary h-full" style="width: 30%;"></div>
                </div>
                <span class="text-xs font-medium text-slate-500">3 of 10 files processed</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 rounded-lg transition-colors">
                Save Draft
            </button>
            <button type="submit" form="form-arsip" class="px-4 py-2 text-sm font-bold bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-primary/20">
                Complete Batch
            </button>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        
        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar bg-slate-50/50">
            
            <form id="form-arsip" action="<?= base_url('staf/arsip/store') ?>" method="POST" enctype="multipart/form-data">
                
                <section class="mb-8">
                    <label for="file_upload" class="border-2 border-dashed border-slate-300 rounded-xl p-8 bg-white flex flex-col items-center justify-center text-center group hover:border-primary transition-colors cursor-pointer">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                        </div>
                        <h3 class="text-lg font-bold mb-1">Drag and drop PDF files here</h3>
                        <p class="text-slate-500 text-sm mb-4">Maximum file size 25MB. PDF formats only.</p>
                        <div class="px-6 py-2 bg-slate-100 text-slate-700 font-bold rounded-lg group-hover:bg-slate-200 transition-colors">
                            Browse Files
                        </div>
                        <input type="file" id="file_upload" name="file_arsip" class="hidden" accept=".pdf" />
                    </label>

                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">picture_as_pdf</span>
                                <span class="text-sm font-medium">Nota_Pembelian_2023_001.pdf</span>
                                <span class="text-xs text-slate-400">1.2 MB</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-bold rounded uppercase">Processed</span>
                                <span class="material-symbols-outlined text-slate-400 text-lg cursor-pointer hover:text-red-500">delete</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        <h3 class="text-lg font-bold">Document Metadata</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Nomor Surat / Nota</label>
                                <input name="nomor_surat" required class="w-full h-11 bg-slate-50 border-slate-200 rounded-lg focus:ring-primary focus:border-primary px-4" placeholder="Contoh: INV/2026/1024" type="text"/>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Tanggal Surat</label>
                                <input name="tanggal_surat" required class="w-full h-11 bg-slate-50 border-slate-200 rounded-lg focus:ring-primary focus:border-primary px-4" type="date"/>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Pengirim / Tujuan</label>
                                <input name="pengirim_tujuan" required class="w-full h-11 bg-slate-50 border-slate-200 rounded-lg focus:ring-primary focus:border-primary px-4" placeholder="Contoh: PT. Pertamina" type="text"/>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Klasifikasi / Jenis Arsip</label>
                                <select name="jenis_arsip" required class="w-full h-11 bg-slate-50 border-slate-200 rounded-lg focus:ring-primary focus:border-primary px-4">
                                    <option value="">Pilih klasifikasi...</option>
                                    <option value="Surat Masuk">Surat Masuk</option>
                                    <option value="Surat Keluar">Surat Keluar</option>
                                    <option value="Berkas Proyek">Berkas Proyek</option>
                                    <option value="SK (Keputusan)">SK (Keputusan)</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Perihal / Subjek</label>
                            <input name="perihal" required class="w-full h-11 bg-slate-50 border-slate-200 rounded-lg focus:ring-primary focus:border-primary px-4" placeholder="Deskripsi ringkas dokumen" type="text"/>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-primary">inventory_2</span>
                                <h3 class="text-base font-bold">Physical Storage Location</h3>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Pilih Kabinet & Rak Penyimpanan</label>
                                <select name="lokasi_penyimpanan" required class="w-full h-11 bg-slate-50 border-slate-200 rounded-lg focus:ring-primary focus:border-primary px-4">
                                    <option value="">Pilih Lokasi...</option>
                                    <option value="Lemari A - Rak 1">Lemari A - Rak 1</option>
                                    <option value="Lemari A - Rak 2">Lemari A - Rak 2</option>
                                    <option value="Lemari B - Box 1">Lemari B - Box 1</option>
                                    <option value="Gudang Arsip Utama">Gudang Arsip Utama</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6">
                            <button class="flex items-center gap-2 px-8 py-3 bg-slate-800 text-white font-bold rounded-lg hover:bg-slate-900 transition-all shadow-lg" type="submit">
                                Save & Next File <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </section>
            </form>
        </div>

        <div class="w-[450px] bg-slate-100 border-l border-slate-200 flex flex-col shrink-0">
            <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-white">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-500">visibility</span>
                    <span class="text-sm font-bold uppercase tracking-wider text-slate-500">Preview</span>
                </div>
                <div class="flex items-center gap-1">
                    <button class="p-1.5 hover:bg-slate-100 rounded transition-colors"><span class="material-symbols-outlined text-lg">zoom_in</span></button>
                    <button class="p-1.5 hover:bg-slate-100 rounded transition-colors"><span class="material-symbols-outlined text-lg">zoom_out</span></button>
                    <button class="p-1.5 hover:bg-slate-100 rounded transition-colors"><span class="material-symbols-outlined text-lg">open_in_new</span></button>
                </div>
            </div>
            
            <div class="flex-1 overflow-hidden p-6 bg-slate-200/50">
                <div class="w-full h-full flex items-center justify-center overflow-y-auto custom-scrollbar">
                    
                    <div class="w-full max-w-sm bg-white shadow-xl rounded-sm p-8 min-h-[500px] flex flex-col gap-6 relative">
                        <div class="flex justify-between items-start">
                            <div class="w-16 h-16 bg-slate-200 rounded"></div>
                            <div class="text-right">
                                <div class="w-24 h-4 bg-slate-200 rounded mb-2 ml-auto"></div>
                                <div class="w-32 h-3 bg-slate-100 rounded ml-auto"></div>
                            </div>
                        </div>
                        <div class="space-y-3 mt-8 z-10">
                            <div class="w-full h-4 bg-slate-200 rounded"></div>
                            <div class="w-5/6 h-4 bg-slate-100 rounded"></div>
                            <div class="w-full h-4 bg-slate-100 rounded"></div>
                            <div class="w-4/5 h-4 bg-slate-100 rounded"></div>
                        </div>
                        
                        <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
                            <span class="material-symbols-outlined text-[150px]">description</span>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="p-4 bg-white border-t border-slate-200 flex items-center justify-between text-xs text-slate-500 font-medium">
                <span>Page 1 of 1</span>
                <div class="flex items-center gap-2">
                    <button class="px-2 py-1 rounded hover:bg-slate-100 transition-colors disabled:opacity-30" disabled>Previous</button>
                    <button class="px-2 py-1 rounded hover:bg-slate-100 transition-colors disabled:opacity-30" disabled>Next</button>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?= $this->endSection() ?>