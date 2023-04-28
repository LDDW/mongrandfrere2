<x-datatable>
    <x-slot name="header">
        <x-select fieldName="paginate" wire:model="paginate" width="16">
            <option value="{{ $paginate }}">{{ $paginate }}</option>
            @foreach ($paginates as $p)
                @if ($paginate !== $p)
                    <option value="{{ $p }}">{{ $p }}</option>
                @endif
            @endforeach
        </x-select>
        <x-datatable-search wire:model.debounce.500ms="search" placeholder="Rechercher un article"/>
        <a href="{{ Route('admin.article.create') }}" class="flex items-center justify-center rounded-sm px-4 min-w-fit h-10 text-[13px] font-semibold shadow-sm bg-blue-500 hover:bg-blue-600 text-white">Créer un article</a>
    </x-slot>
    @if (count($articles) > 0)
        <x-slot name="thead">
            <th class="w-96 text-left">TITRE</th>
            <th class="w-32 text-left">STATUS</th>
            <th class="w-60 text-left">DATE DE CRÉATION</th>
        </x-slot>
        <x-slot name="tbody">
            @foreach ($articles as $i => $art)
                <tr class="h-12 {{$i % 2 == 0 ? 'bg-gray-50' :''}} border-t border-gray-200 text-gray-900 flex flex-row">
                    <td class="w-96"><p class="truncate">{{ $art->title }}</p></td>
                    <td class="w-32"><p class="truncate">{{ $art->status === 'draft' ? 'Brouillon' : 'Publié' }}</p></td>
                    <td class="w-60"><p class="truncate">{{ $art->created_at }}</p></td>
                    <td class="w-full min-w-[128px] pl-2 h-12 flex items-center gap-2">
                        <a href="{{ Route('admin.article', ['article' => $art->id]) }}">
                            <button class="text-gray-100 flex items-center justify-center w-12 h-8 rounded-sm bg-green-400 hover:bg-green-500" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                                               
                            </button>
                        </a>

                        <form action="{{ Route('admin.article.destroy', ['article' => $art->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="text-gray-100 flex items-center justify-center w-12 h-8 rounded-sm bg-red-400 hover:bg-red-500" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>                              
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </x-slot>
    @endif
    <x-slot name="noResult">
        @if (count($articles) === 0)
            <div class="h-[50vh] w-full flex items-center justify-center text-xl"><p>Aucun résultat</p></div>
        @endif
    </x-slot>
    <x-slot name="pages">
        @if($articles->lastPage() > 1)<div class="paginate_bar">{{ $articles->links() }}</div>@endif
    </x-slot>
</x-datatable>