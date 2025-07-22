import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [RouterLink],
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
