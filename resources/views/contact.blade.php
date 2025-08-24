@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 bg-gradient-subtle">
    <div class="container mx-auto">
        <div class="text-center">
            <h1 class="font-serif text-5xl lg:text-6xl font-bold text-text mb-6">
                Contact Us
            </h1>
            <p class="text-xl text-text-light max-w-2xl mx-auto leading-relaxed">
                We'd love to hear from you. Get in touch with us for any questions about our products or personalized skincare advice.
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Information -->
                <div>
                    <h2 class="font-serif text-3xl font-bold text-text mb-8">Get in Touch</h2>
                    
                    <div class="space-y-8">
                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-text mb-2">Phone</h3>
                                <p class="text-text-light text-lg">+92 300 1234567</p>
                                <p class="text-sm text-text-muted mt-1">Available during business hours</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-light rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-text mb-2">Email</h3>
                                <p class="text-text-light text-lg">info@organixa.com</p>
                                <p class="text-sm text-text-muted mt-1">We'll respond within 24 hours</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-accent to-accent-light rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-text mb-2">Address</h3>
                                <p class="text-text-light text-lg">
                                    Gulberg III, Lahore<br>
                                    Punjab, Pakistan
                                </p>
                                <p class="text-sm text-text-muted mt-1">Visit us for personalized consultations</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-light rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-serif font-semibold text-text mb-2">Business Hours</h3>
                                <p class="text-text-light text-lg">
                                    Monday - Friday: 9:00 AM - 6:00 PM<br>
                                    Saturday: 10:00 AM - 4:00 PM<br>
                                    Sunday: Closed
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="card p-8 shadow-xl">
                    <h2 class="font-serif text-3xl font-bold text-text mb-8">Send us a Message</h2>
                    
                    <form class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-text mb-2">Full Name</label>
                            <input type="text" id="name" name="name" required class="form-input">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-text mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="form-input">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-text mb-2">Subject</label>
                            <select id="subject" name="subject" required class="form-input">
                                <option value="">Select a subject</option>
                                <option value="product-inquiry">Product Inquiry</option>
                                <option value="skincare-advice">Skincare Advice</option>
                                <option value="order-support">Order Support</option>
                                <option value="general">General Question</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-text mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required class="form-input resize-none"></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gradient-subtle">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl font-bold text-text mb-6">Frequently Asked Questions</h2>
                <p class="text-xl text-text-light">Find answers to common questions about our products and services.</p>
            </div>

            <div class="space-y-6">
                <div class="card p-6">
                    <h3 class="font-serif text-xl font-semibold text-text mb-3">Are your products really 100% natural?</h3>
                    <p class="text-text-light">Yes, all our products are made with 100% natural and organic ingredients. We never use synthetic chemicals, parabens, or artificial fragrances.</p>
                </div>

                <div class="card p-6">
                    <h3 class="font-serif text-xl font-semibold text-text mb-3">How long does shipping take?</h3>
                    <p class="text-text-light">We offer fast delivery across Pakistan. Standard shipping takes 2-3 business days, while express shipping delivers within 24 hours in major cities.</p>
                </div>

                <div class="card p-6">
                    <h3 class="font-serif text-xl font-semibold text-text mb-3">Do you offer refunds?</h3>
                    <p class="text-text-light">We offer a 30-day money-back guarantee on all our products. If you're not satisfied, simply return the unused portion for a full refund.</p>
                </div>

                <div class="card p-6">
                    <h3 class="font-serif text-xl font-semibold text-text mb-3">Can I get personalized skincare advice?</h3>
                    <p class="text-text-light">Absolutely! Our skincare experts are available for consultations. Contact us to schedule a personalized session to find the perfect products for your skin type.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 