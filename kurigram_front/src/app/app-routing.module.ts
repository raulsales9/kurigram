import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './views/home/home.component';
import { ContactComponent } from './views/contact/contact.component';
import { EventsComponent } from './views/events/events.component';
import { SigninComponent } from './views/signin/signin.component';
import { ProfileComponent } from './views/profile/profile.component';
import { PostsComponent } from './views/posts/posts.component';
import { GenteComponent } from './views/gente/gente.component';
import { IniciarSesionComponent } from './views/iniciar-sesion/iniciar-sesion.component';
import { GuardControlGuard } from './guard-control.guard';

const routes: Routes = [
  { path: '', component: HomeComponent, canActivateChild: [GuardControlGuard]  },
  { path: 'home', component: HomeComponent },
  
  { path: 'contact', component: ContactComponent, canActivateChild: [GuardControlGuard] },
  { path: 'events', component: EventsComponent },
  { path: 'signin', component: SigninComponent },
  { path: 'iniciarsesion', component: IniciarSesionComponent },
  { path: 'profile', component: ProfileComponent,  canActivateChild: [GuardControlGuard]  },
  { path: 'posts', component: PostsComponent},
  { path: 'gente', component: GenteComponent, canActivateChild: [GuardControlGuard] },
  { path: '**', redirectTo: '/home',canActivateChild: [GuardControlGuard]  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
