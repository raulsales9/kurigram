import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service.service';

@Component({
  selector: 'app-login',
  templateUrl: './Login.component.html',
  styleUrls: ['./Login.component.css']
})
export class LoginComponent {
  isAuthenticated = false;

  email: string = '';
  password: string = '';

  constructor(private AuthService: AuthService, private router: Router) {}

  login(): void {
    const user = {
      email: this.email,
      password: this.password
    };

    this.AuthService.loginOrRegister(user, true).subscribe(
      data => {
        // save the token to localStorage
        localStorage.setItem('token', data.token);

        this.AuthService.isLoggedIn = true; 

        // set isAuthenticated to true
        this.isAuthenticated = true;

        // redirect to the home page
        this.router.navigate(['/home']);
      },
      error => {
        console.log(error);
        // handle the error
      }
    );
  }

  public isUserAuthenticated(): boolean {
    // Check if an authentication token exists in local or session storage
    const token = localStorage.getItem('token') || sessionStorage.getItem('token');
    return !!token; // Return true if token exists, false otherwise
  }
}