import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RequestService } from 'src/app/services/request.service'; 

@Component({
  selector: 'app-iniciarsesion',
  templateUrl: './iniciar-sesion.component.html',
  styleUrls: ['./iniciar-sesion.component.css']
})
export class IniciarSesionComponent {

  email: string = '';
  password: string = '';

  constructor(private requestService: RequestService, private router: Router) {}

  login(): void {
    this.requestService.loginOrRegister({email: this.email, password: this.password}, true).subscribe(
      (response) => {
        // Guardar datos del usuario en almacenamiento local o de sesión
        // Redirigir al usuario a la página de inicio
        this.router.navigate(['/home']);
      },
      (error) => {
        // Mostrar mensaje de error al usuario
        console.error(error);
      }
    );
  }
}
