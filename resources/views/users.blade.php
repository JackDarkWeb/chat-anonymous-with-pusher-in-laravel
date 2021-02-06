
<div class="col-md-4 col-lg-3 pt-5 sidebar color-bg">
    <ul class="list-unstyled my-3 text-light row">
        @foreach($users as $user)
            <li class="bg-light m-2 rounded">
                  <span class="chat-img">
                      <img src="https://eu.ui-avatars.com/api/?name={{ $user->user_name }}" alt="User Avatar" class="img-circle mr-1" />
                  </span>
                <span class="chat-id text-dark">{{ $user->user_name }}</span>
            </li>
        @endforeach
    </ul>
</div>
