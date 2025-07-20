import { Component } from '@angular/core';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css',
})
export class NavbarComponent {
  isMobileMenuActive: boolean = false;
  // Method to toggle the mobile menu
  toggleMobileMenu() {
    this.isMobileMenuActive = !this.isMobileMenuActive;
  }
}
