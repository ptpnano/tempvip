<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6" x-cloak wire:ignore.self>
    @if (empty($token))
        <h2>BUild GUI create email</h2>
        
    @else

        <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row" x-data="{ create: 1 }">
                    <div >
                        <form x-show="create == {{ $show_create }}" wire:submit="save">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Email</label>
                                    <input required type="email" class="form-control" wire:model="email">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <button type="submit" class="btn btn-info w-100">Save</button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if(!empty($mail))
                        <div x-data="{ open: false }">
                            <div class="position-relative">
                                <button @click.away="open = false" x-on:click="open = !open" class="dropdown-toggle btn btn-outline-info w-100" style="text-transform: none;">{{ $mail }}</button>
                                <div class="card w-100" x-show="open" style="background-color: #f8f9fa !important; position: absolute; z-index: 1000">
                                    <div class="nav-wrapper position-relative end-0">
                                        @foreach ($token as $key => $value)
                                            @if($key=='emails')
                                                @if(!empty($value))
                                                    @foreach($value as $k => $v)
                                                        <div class="nav-item rounded-md shadow-xs max-h-96 overflow-y-auto py-1">
                                                            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out nav-link " 
                                                            href="/email/{{ $v }}">{{ $v }}</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    
                    <div class="col-md-3"> 
                        <button type="button" class="btn btn-info w-100"><i class="far fa-copy me-1"></i>Copy</button>
                    </div>
                    <div class="col-md-3">
                        <button wire:click="refreshComponent" type="button" class="btn btn-info w-100"><i class="refresh fas fa-sync-alt fa-spin me-1"></i>Refresh</button>
                    </div>
                    <div class="col-md-3">
                        <button x-on:click="create = !create" type="button" class="btn btn-info w-100"><i class="far fa-plus-square me-1"></i>New</button>
                    </div>
                    <div class="col-md-3">
                        <button wire:click="remove()" type="button" class="btn btn-info w-100 bg-blue"><i class="far fa-trash-alt me-1"></i>Remove</button>
                    </div>
                </div>
                
                
                <div class="row height-600" style="max-height: 600px">
                    <div x-data="{ id: 0, detail: false }">
                        <div x-show="detail" class="h-100">
                            <div class="card h-100">
                                {{-- <button type="button" @click="detail = !detail" class="border-indigo-500 p-2"">Back</button> --}}
                                <div class="head flex items-center py-2 px-3 lg:rounded-t-md bg-gray-100">
                                    <div class="w-full flex justify-between items-center">
                                        <div x-on:click="detail = false" class="flex items-center cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                            <span class="ml-2">Go Back to Inbox</span>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($listemails as $email)
                                    <div x-show="id == {{ $email->id }}" style="min-height: calc(100vh - 500px);" class="message min-h-tm-half">
                                        <div class="flex justify-between items-center py-2 px-3 border-t border-dashed" style="">
                                            <div>
                                                {{ $email->sender }}
                                                {{-- <div class="text-xs overflow-ellipsis">
                                                    hello@creative-tim.com
                                                </div> --}}
                                            </div>
                                            <div class="flex" style="align-items: center;">
                                                <div class="text-xs overflow-ellipsis align-middle text-center">
                                                    {{ $email->time }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-t  border-dashed py-2 px-3">
                                            {{ $email->subject }}
                                        </div>
                                        <div class="border-t border-dashed"></div>
                                        <iframe srcdoc="{{ base64_decode($email->content) }}" class="w-100 h-100"></iframe>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div x-show="!detail" class="h-100">
                            <div class="card h-100">
                                <div class="table-responsive">
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sender</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                                        {{-- <th class="text-secondary opacity-7"></th> --}}
                                      </tr>
                                    </thead>
                                    <tbody>
                                      
                                        @foreach ($listemails as $email)
                                          <tr wire:key="{{ $email->id }}" @click="detail = true; id = {{ $email->id }}" class="cursor-pointer">
                                            <td>
                                              <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-xs">{{ $email->sender }}</h6>
                                                  {{-- <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p> --}}
                                                </div>
                                              </div>
                                            </td>
                                            <td>
                                              <p class="text-xs font-weight-bold mb-0">{{ $email->subject }}</p>
                                              {{-- <p class="text-xs text-secondary mb-0">Developer</p> --}}
                                            </td>
                                            <td class="align-middle text-center">
                                              <span class="text-secondary text-xs font-weight-normal">{{ $email->time }}</span>
                                            </td>
                                            {{-- <td class="align-middle flex" style="align-items: center;">
                                                <button type="button" class="btn btn-outline-info w-100" style="background:#dde9f8;">Read</button>
                                            </td> --}}
                                          </tr>
                                        @endforeach

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9 mx-auto py-3">
                        <div class="row">
                            <div class="col-md-4 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"><span id="state1" countTo="70">0</span>+</h1>
                                    <h5 class="mt-3">Coded Elements</h5>
                                    <p class="text-sm font-weight-normal">From buttons, to inputs, navbars, alerts or cards, you are covered</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-4 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+</h1>
                                    <h5 class="mt-3">Design Blocks</h5>
                                    <p class="text-sm font-weight-normal">Mix the sections, change the colors and unleash your creativity</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>
                                    <h5 class="mt-3">Pages</h5>
                                    <p class="text-sm font-weight-normal">Save 3-4 weeks of work when you use our pre-made pages for your website</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Đây là nơi hiển thị nội dung Email
                    Đây là nơi hiển thị nội dung Email
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            setInterval(() => {
                $wire.$refresh()
            }, 5000)
        </script>
    @endscript
        
</div>

