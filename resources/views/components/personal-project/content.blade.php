 <!-- Content Section -->
 <section class="content-section-modern">
     <div class="container">
         <div class="row">
             <!-- Main Content -->
             <div class="col-lg-8">
                 <!-- Tech Stack -->
                 @if($project->technologies && is_array($project->technologies))
                 <div class="tech-stack-modern fade-in-up">
                     <h3 class="tech-stack-title">
                         <i class="fas fa-layer-group"></i>
                         Technology Stack
                     </h3>
                     <div class="tech-pills-modern">
                         @foreach($project->technologies as $tech)
                         <span class="tech-pill-modern">
                             @if($tech == 'Laravel')
                                 <i class="fab fa-laravel text-danger"></i>
                             @elseif($tech == 'PHP')
                                 <i class="fab fa-php text-primary"></i>
                             @elseif($tech == 'JavaScript')
                                 <i class="fab fa-js-square text-warning"></i>
                             @elseif($tech == 'Flutter')
                                 <i class="fab fa-flutter" style="color: #02569B;"></i>
                             @elseif($tech == 'MySQL')
                                 <i class="fas fa-database text-info"></i>
                             @elseif($tech == 'React')
                                 <i class="fab fa-react text-info"></i>
                             @elseif($tech == 'Vue')
                                 <i class="fab fa-vuejs text-success"></i>
                             @elseif($tech == 'Node.js')
                                 <i class="fab fa-node-js text-success"></i>
                             @else
                                 <i class="fas fa-code"></i>
                             @endif
                             {{ $tech }}
                         </span>
                         @endforeach
                     </div>
                 </div>
                 @endif
                 
                 <!-- Project Details -->
                 @if($project->content)
                 <div class="project-content-modern fade-in-up">
                     <h3 class="content-title-modern">
                         <i class="fas fa-file-alt"></i>
                         Project Overview
                     </h3>
                     <div class="content">
                         {!! $project->sanitizedHtml() !!}
                     </div>
                 </div>
                 @endif
             </div>
             
             <!-- Sidebar -->
             <div class="col-lg-4">
                 <!-- Project Info -->
                 <div class="info-card-modern fade-in-up">
                     <h4 class="info-card-title">Project Information</h4>
                     
                     <div class="info-item-modern">
                         <div class="info-label-modern">Project Date</div>
                         <div class="info-value-modern">
                             <i class="fas fa-calendar-alt"></i>
                             <span>{{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}</span>
                         </div>
                     </div>
                     
                     @if($project->github_url)
                     <div class="info-item-modern">
                         <div class="info-label-modern">Source Code</div>
                         <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="info-link-modern">
                             <i class="fab fa-github"></i>
                             <span>View Repository</span>
                             <i class="fas fa-arrow-right ms-auto"></i>
                         </a>
                     </div>
                     @endif
                     
                     @if($project->live_url)
                     <div class="info-item-modern">
                         <div class="info-label-modern">Live Project</div>
                         <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="info-link-modern">
                             <i class="fas fa-globe"></i>
                             <span>Visit Website</span>
                             <i class="fas fa-arrow-right ms-auto"></i>
                         </a>
                     </div>
                     @endif
                 </div>
                 
                 <!-- Other Projects -->
                 @if($otherProjects->count() > 0)
                 <div class="other-projects-card fade-in-up">
                     <h4 class="info-card-title">More Projects</h4>
                     
                     @foreach($otherProjects as $other)
                     <div class="project-item-mini">
                         <h6>
                             <a href="{{ route('personal.project.show', $other->slug) }}">
                                 {{ $other->title }}
                             </a>
                         </h6>
                         <p>{{ Str::limit($other->description, 80) }}</p>
                         @if($other->technologies && is_array($other->technologies))
                         <div>
                             @foreach(array_slice($other->technologies, 0, 3) as $tech)
                             <span class="mini-tech-badge">{{ $tech }}</span>
                             @endforeach
                             @if(count($other->technologies) > 3)
                             <span class="mini-tech-badge">+{{ count($other->technologies) - 3 }}</span>
                             @endif
                         </div>
                         @endif
                     </div>
                     @endforeach
                     
                     <a href="{{ route('personal.projects.all') }}" class="btn-view-all-projects">
                         <span>View All Projects</span>
                         <i class="fas fa-arrow-right"></i>
                     </a>
                 </div>
                 @endif
             </div>
         </div>
     </div>
 </section>
