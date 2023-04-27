import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RequestService } from 'src/app/services/request.service'; 
import { AutentificationService } from 'src/app/services/autentification.service';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  email: string = "";
  password: string = "";

  constructor(public service :RequestService, private router :Router, public Autentification : AutentificationService){}

  public OnLogged(){
    this.service.getLogs(this.email, this.password).subscribe(response=>{
      if (typeof response === "object") {
        this.Autentification.login(response);
      } else {
        alert("An error occurred");
      }
    });
  }
}
