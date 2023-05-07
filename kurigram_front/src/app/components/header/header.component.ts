import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  isLoggedIn = false;

  constructor(private request: RequestService, private router: Router, private authService: AuthService) {}

  ngOnInit(): void {
    this.isLoggedIn = this.authService.isLoggedIn;
  }

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
