<h2>Search</h2>
  <form action="/search" method="get">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <input type="text" name="term" class="form-control" placeholder="Search" value="{{ Request::get('term') }}">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <select name="by" class="form-control">
          <option @if(Request::get('by') == 'tow_number') selected @endif value="tow_number">Tow Number</option>
          <option @if(Request::get('by') == 'tags') selected @endif value="tags">Tags</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <button type="submit" class="btn btn-default pull-right">Search</button>
      </div>
    </div>
  </div>
</form>
