import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './views/home/home.component';
import { ContactComponent } from './views/contact/contact.component';
import { ProfileComponent } from './views/profile/profile.component';
import { PostsComponent } from './views/posts/posts.component';
import { GenteComponent } from './views/gente/gente.component';
import { GuardControlGuard } from './guard-control.guard';
import { EventsComponent } from './views/events/events.component';
import { PostFormComponent } from './views/new-post/new-post.component';
import { MessagesComponent } from './views/messages/messages.component';
import { SettingsComponent } from './views/settings/settings.component';
import { SignupComponent } from './views/signup/signup.component';
import { LoginComponent } from './views/login/login.component';


const routes: Routes = [
  { path: '', component: HomeComponent,  },
  { path: 'home', component: HomeComponent },
  
  { path: 'contact', component: ContactComponent/* , canActivateChild: [GuardControlGuard] */ },
  { path: 'events', component: EventsComponent },
  { path: 'signup', component: SignupComponent },
  { path: 'login', component: LoginComponent },
  { path: 'profile', component: ProfileComponent  },
  { path: 'posts', component: PostsComponent},
  { path: 'gente', component: GenteComponent },
  { path: 'message', component: MessagesComponent/*,  canActivateChild: [GuardControlGuard] */  },
  { path: 'newpost', component: PostFormComponent/* , canActivateChild: [GuardControlGuard] */ },
  { path: 'setting', component: SettingsComponent/* , canActivateChild: [GuardControlGuard]  */},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
