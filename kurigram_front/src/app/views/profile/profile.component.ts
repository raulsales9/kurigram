import { Component } from '@angular/core';
import { AutentificationService } from 'src/app/services/autentification.service';
import { RequestService } from 'src/app/services/request.service';
import { User, contents } from './profile.interface';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent {

  constructor(public service: RequestService, public Auth : AutentificationService) { }

  public perfil: number = 1;
  public contents: User = contents;
  public id: any = localStorage.getItem('id');

  public nombre : string = "";
  public apellidos : string = "";
  public telefono : string = "";
  public email : string = "";

  public peticio() {
    this.service.getUser(this.id).subscribe(response => {
      this.contents = {
        name: response.name,
        Email: response.email,
        phone: response.phone,
        events: response.events,
      };

      this.nombre = response.name;
      this.telefono = response.phone;
      this.email = response.email
    });

  }

  ngOnInit() {
    this.perfil = 1;
    this.peticio();
    console.log(this.id);
  }

  public onClic() {
    this.perfil = 2;
  }

  public onSubmit() {
    this.service.updateUser(this.id, this.nombre, this.apellidos, this.email, this.telefono).subscribe(response => { 
      console.log(response);
    });
    this.perfil = 1;
    this.peticio();
  }

  public cerrarSesion() 
  {
    this.Auth.logOut();
}



}