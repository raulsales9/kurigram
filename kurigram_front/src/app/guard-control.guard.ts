import { Injectable } from '@angular/core';
import { CanActivateChild, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { RequestService } from './services/request.service';

@Injectable({
  providedIn: 'root'
})
export class GuardControlGuard implements CanActivateChild  {
  constructor(private request: RequestService, private router: Router) {}

  canActivateChild() {
    if (this.request.getCurrentUser()) {
      return true;
    } else {
      this.router.navigate(['/iniciarsesion']);
      return false;
    }
  }
}
