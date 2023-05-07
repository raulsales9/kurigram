import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service.service';
import { HeaderComponent } from 'src/app/components/header/header.component';
import { User } from 'src/app/models/user';
import { Registry } from 'src/app/models/registry';
@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent {

  email: string;
  name: string;
  phone: string;
  password: string;
  confirmPassword: string;

  constructor(private authService: AuthService, private router: Router) {}

  public onRegistry(): void {
    const newUser: Registry = {
      email: this.email,
      name: this.name,
      phone: this.phone,
      password: this.password,
      confirmPassword: this.confirmPassword
    };
    this.authService.registerUser(newUser).subscribe(
      (data: any) => {
        console.log(data);
        this.authService.isLoggedIn = true; 
        this.router.navigate(['/home']);
      },
      (error: any) => {
        console.log(error);
      }
    );
  }
  
}