<!-- Home Section Start -->
<section class="home d-flex align-items-center">
  <div class="effect-wrap">
    <i class="fas fa-plus effect effect-1"></i>
    <i class="fas fa-plus effect effect-2"></i>
    <i class="fas fa-circle-notch effect effect-3"></i>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="home-text">
          <h1>{{$tran['Mailbox Small Title']}}</h1>
          <div class="custom-email">
            <input type="text" class="custom-email-input" id="trsh_mail" readonly>
            <button type="button" data-toggle="tooltip" data-placement="bottom" title="Click To Copy!"
              data-clipboard-target="#trsh_mail" class="custom-email-botton">
              <i class="fas fa-copy"></i>
            </button>
          </div>
          <div class="home-btn">
            <div class="row align-items-center">
              <div class="col text-center"><a href="{{route('home')}}" class="btn btn-1"><i class="fas fa-redo-alt"></i> {{$tran['Refresh']}}</a></div>
              <div class="col text-center"><a href="{{route('change')}}" class="btn btn-1"><i class="fas fa-pencil-alt"></i> {{$tran['Change']}}</a></div>
              <div class="col text-center"><a href="{{route('delete')}}" class="btn btn-1"><i class="far fa-trash-alt"></i> {{$tran['Delete']}}</a></div>
            </div>
          </div>
        </div>
        <div class="counter">
          <span class=" count_ mail_count">
            <b>{{$tran['Emails Created']}}</b>
            <em class="css_spirite">{{$setdata['emails_created'] + $setdata['total_emails_created']}}</em>
          </span>
          <span class=" count_ mail_count">
            <b>{{$tran['Messages Received']}}</b>
            <em class="css_spirite">{{$setdata['messages_received'] + $setdata['total_messages_received']}}</em>
          </span>
        </div>
        <p>
          {{$tran['Mailbox Description']}}
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Home Section End -->