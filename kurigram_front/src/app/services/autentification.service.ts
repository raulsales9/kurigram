import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Login } from '../models/login';
@Injectable({
  providedIn: 'root'
})
export class AutentificationService {
  isUserLoggedIn : boolean = false;

  constructor(private router: Router ) { }

  public login(user: Login)
  {
    this.isUserLoggedIn = true;
    localStorage.setItem('isUserLoggedIn', this.isUserLoggedIn ? "true" : "false")
    localStorage.setItem('userName', user.user)
    localStorage.setItem('email', user.email)
    localStorage.setItem('id', user.id.toString())

    if (localStorage.getItem('isUserLoggedIn') === "true") {
      this.router.navigate(['/home']);
    }else{
      alert("Usuario o contraseña incorrectos");
    }
  }

  public logOut() {
    this.isUserLoggedIn = false;
    localStorage.setItem('isUserLoggedIn', "false")
    localStorage.setItem('userName', "")
    localStorage.setItem('email', "")
    localStorage.setItem('id', "")

    if (localStorage.getItem('isUserLoggedIn') === "false") {
      this.router.navigate(['/login']);
    }else{
      alert("No se ha podido cerrar sesión");
    }
  }
}
