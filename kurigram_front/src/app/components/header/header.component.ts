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
  currentUser: any;
  isUserAuthenticated: boolean;

  constructor(private authService: AuthService) {}

  ngOnInit() {
    this.authService.isUserAuthenticated().subscribe(isAuthenticated => {
      this.isUserAuthenticated = isAuthenticated;
    });
  }
  

  logout(): void {
    this.authService.logout();
    this.currentUser = null;
  }
}