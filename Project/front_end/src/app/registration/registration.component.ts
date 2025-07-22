import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-registration',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './registration.component.html',
  styleUrl: './registration.component.css',
})
export class RegistrationComponent {
  selectedMethod = 'mobile';
  mobileNumber: string = '';
  getOTP() {
    if (this.mobileNumber) {
      console.log('Sending OTP to mobile number:', this.mobileNumber);
      alert(`OTP has been sent to ${this.mobileNumber}`);
    } else {
      alert('Please enter a valid mobile number.');
    }
  }
}
