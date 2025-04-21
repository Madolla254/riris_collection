<x-layout>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-light text-center">
                <h2>Terms & Conditions</h2>
                <p class="text-muted">Effective Date: 01 January 2025 | Last Updated: 01 January 2025</p>
            </div>
            <div class="card-body">
                
                <!-- 1️⃣ General Terms -->
                <h4 class="text-primary">1️⃣ General Terms</h4>
                <p>✅ <strong>1.1</strong> These Terms and Conditions govern your use of our e-commerce platform.</p>
                <p>✅ <strong>1.2</strong> By making a purchase, you confirm that you are 18 years or older or have parental consent.</p>
                <p>✅ <strong>1.3</strong> We reserve the right to change these terms at any time without prior notice.</p>

                <!-- 2️⃣ User Accounts -->
                <h4 class="text-primary">2️⃣ User Accounts</h4>
                <p>✅ <strong>2.1</strong> You may need to create an account to place an order.</p>
                <p>✅ <strong>2.2</strong> You are responsible for maintaining the confidentiality of your login credentials.</p>
                <p>✅ <strong>2.3</strong> Any misuse or fraudulent activity may result in account suspension.</p>

                <!-- 3️⃣ Product Listings -->
                <h4 class="text-primary">3️⃣ Product Listings & Pricing</h4>
                <p>✅ <strong>3.1</strong> All product descriptions, images, and prices are accurate to the best of our ability.</p>
                <p>✅ <strong>3.2</strong> Prices are inclusive/exclusive of VAT, depending on Kenya Revenue Authority (KRA) regulations.</p>
                <p>✅ <strong>3.3</strong> We reserve the right to modify prices or correct errors without prior notice.</p>

                <!-- 4️⃣ Payment Terms -->
                <h4 class="text-primary">4️⃣ Payment & Transactions</h4>
                <p>💳 <strong>4.1</strong> Payments are processed securely via M-Pesa, Bank Transfers, Debit/Credit Cards, and other trusted methods.</p>
                <p>💳 <strong>4.2</strong> We comply with the Consumer Protection Act 2012, ensuring transparent pricing and fair transactions.</p>
                <p>💳 <strong>4.3</strong> Unauthorized transactions may be investigated and reported.</p>

                <!-- 5️⃣ Shipping & Delivery -->
                <h4 class="text-primary">5️⃣ Shipping & Delivery</h4>
                <p>🚚 <strong>5.1</strong> Orders are processed within **24 hours** and delivered through trusted couriers.</p>
                <p>🚚 <strong>5.2</strong> Customers must provide accurate shipping details; we are not liable for incorrect addresses.</p>
                <p>🚚 <strong>5.3</strong> Delays caused by external factors (e.g., weather, supplier issues) will be communicated promptly.</p>

                <!-- 6️⃣ Returns & Refunds -->
                <h4 class="text-primary">6️⃣ Returns & Refunds</h4>
                <p>🔄 <strong>6.1</strong> Returns must be initiated within **2 days** of receiving the product.</p>
                <p>🔄 <strong>6.2</strong> Items must be **unused, in original packaging**, and accompanied by a receipt for eligibility.</p>
                <p>🔄 <strong>6.3</strong> Refunds are processed based on our Return Policy, in line with the Kenya Consumer Protection Act.</p>

                <!-- 7️⃣ Privacy Policy -->
                <h4 class="text-primary">7️⃣ Privacy & Data Protection</h4>
                <p>🔒 <strong>7.1</strong> Your data is handled in compliance with Kenya’s Data Protection Act (2019).</p>
                <p>🔒 <strong>7.2</strong> We collect only necessary personal data to fulfill orders and improve user experience.</p>
                <p>🔒 <strong>7.3</strong> You have the right to request deletion or modification of your personal data.</p>
                <p>🔒 <strong>7.4</strong> We implement **security measures** to protect your data from unauthorized access.</p>

                <!-- 8️⃣ Cancellation Policy -->
                <h4 class="text-danger">8️⃣ Cancellation Policy</h4>
                <p>⏳ <strong>8.1</strong> Orders can be <span>canceled within 24 hours</span> after purchase, provided they have <span >not yet been shipped</span>.</p>
                <p>⏳ <strong>8.2</strong> If an order is already processed or shipped, cancellation <span>will not be possible</span>, and standard return/refund policies will apply.</p>
                <p>⏳ <strong>8.3</strong> To request a cancellation, customers must <span>contact customer support</span> via email or phone with their order details.</p>
                <p>⏳ <strong>8.4</strong> If approved, refunds will be processed using the <span >original payment method</span> within <span>7 business days</span>.</p>
                <p>⏳ <strong>8.5</strong> We <span >reserve the right</span> to cancel any order due to fraud suspicion, payment failure, or stock unavailability.</p>

                <!-- 9️⃣ Intellectual Property -->
                <h4 class="text-primary">9️⃣ Intellectual Property</h4>
                <p>© <strong>9.1</strong> All website content, trademarks, and materials are owned by **{{env('OMPANY_NAME')}}**.</p>
                <p>© <strong>9.2</strong> Unauthorized use or reproduction may result in **legal action**.</p>

                <!-- 🔟 Governing Law -->
                <h4 class="text-primary">🔟 Governing Law</h4>
                <p>⚖️ <strong>10.1</strong> These Terms & Conditions are governed by the **laws of Kenya**.</p>
                <p>⚖️ <strong>10.2</strong> Any disputes will be settled under the **Kenyan judicial system**.</p>

                <!-- 📌 Contact Info -->
                <h4 class="text-primary">📌 Contact Information</h4>
                <p>For questions or concerns about these Terms, please contact us at:</p>
                <p>📧 Email: **{{ env('ADMIN_EMAIL') }}**</p>
                <p>📞 Phone: **{{ env('ADMIN_PHONE_NUMBER') }}**</p>
                <p>📍 Address: **{{ env('BUSINESS_ADDRESS') }}**</p>
            </div>
        </div>
    </div>
</x-layout>
