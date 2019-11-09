<div class="m-list-search__results">
    <span class="m-list-search__result-message m--hide">No record found</span>

    @if($accounts->count())
        <span class="m-list-search__result-category m-list-search__result-category--first">Kunden</span>
        @foreach ($accounts as $accounts)
            <a href="#" class="m-list-search__result-item">
                <span class="m-list-search__result-item-icon">
                    <a class="m-list-search__result-item-text" href="{{url('admin/accounts/view/').'/'.$accounts->id.'/0'}}">{{$accounts->account_name}}</a>
                </span>
            </a>
        @endforeach
    @endif

    @if($contacts->count())
        <span class="m-list-search__result-category">Kunden Kontakte</span>
        @foreach ($contacts as $contacts)
            <a href="#" class="m-list-search__result-item">
                <span class="m-list-search__result-item-icon">
                    <a class="m-list-search__result-item-text" href="{{url('admin/contacts/view/').'/'.$contacts->id}}">
                        {{$contacts->first_name.' '.$contacts->last_name}}
                    </a>
                </span>
                &nbsp; &nbsp; / &nbsp; &nbsp;
                <span class="m-list-search__result-item-icon">
                    <a class="m-list-search__result-item-text" href="{{url('admin/accounts/view').'/'.$contacts->account_id.'/0'}}">
                        {{$contacts->account_name}}
                    </a>
                </span>
            </a>
        @endforeach
    @endif

    @if($opportunities->count())
        <span class="m-list-search__result-category">Projektanfragen und Jobs</span>
        @foreach ($opportunities as $opportunity)
            <a href="#" class="m-list-search__result-item">
                <span class="m-list-search__result-item-icon">
                    <a class="m-list-search__result-item-text" href="{{url('admin/opportunity/edit/').'/'.$opportunity->id}}">
                        {{$opportunity->name}}
                    </a>
                </span>
            </a>
        @endforeach
    @endif

    @if($users->count())
        <span class="m-list-search__result-category">Freelancers</span>
        @foreach ($users as $user)
            @if($user->skill_id!='')
                <a href="#" class="m-list-search__result-item">
                    <span class="m-list-search__result-item-icon">
                        <a class="m-list-search__result-item-text"  href="{{url('admin/edit/skills').'/'.$user->skill_id.'/0'}}">
                            {{$user->fullName}}
                        </a>
                    </span>
                </a>
            @else
                <a href="#" class="m-list-search__result-item">
                    <span class="m-list-search__result-item-icon">
                        <a class="m-list-search__result-item-text" href="{{url('admin/add/skills').'/'.$user->id.'/0'}}">
                            {{$user->fullName}}
                        </a>
                    </span>
                </a>
            @endif
        @endforeach
    @endif
</div>