import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { RequestService } from './services/request.service';

@Injectable({
  providedIn: 'root'
})
export class GuardControlGuard {
   constructor(private request: RequestService, private router: Router) {}

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (this.request.getCurrentUser()) {
      return true;
    } else {
      this.router.navigate(['login']);
      return false;
    }
  } 
}