import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RequestService } from 'src/app/services/request.service';

@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.css']
})
export class SigninComponent {
  email: string = "";
  name: string = "";
  password: string = "";
  confirmPassword: string = "";
  phone :string = "";

  constructor(public service :RequestService, private router: Router){}

  public onRegistry(){
    if (this.password === this.confirmPassword) {
      this.service.registration(this.email, this.name, this.password, this.phone).subscribe(response =>{
        this.router.navigate(['/home']);
      });
    } else {
      alert("An error occurred, the passwords are not equal.");
    }
  }
}
