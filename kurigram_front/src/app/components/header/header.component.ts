import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  constructor(private request: RequestService, private router: Router) {}

  get currentUser() {
    return this.request.getCurrentUser();
  }

  public logout() {
    // Eliminar el token de autenticación del almacenamiento local o de sesión
    localStorage.removeItem('token');
    sessionStorage.removeItem('token');
    // Navegar a la página de inicio de sesión
    this.router.navigate(['/login']);
  }


}
