<x-layout>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-light text-center">
                <h2>Frequently Asked Questions (FAQs)</h2>
                <p class="text-muted">Find answers to common questions about our e-commerce platform.</p>
            </div>
            <div class="card-body">
                
                <!-- 1️⃣ Account & Login -->
                <h4 class="text-primary">1️⃣ Account & Login</h4>
                <p>🔑 <strong>Q1:</strong> How do I create an account?</p>
                <p>✅ <strong>A:</strong> Click on "Sign Up" and fill in your details. A verification email will be sent.</p>

                <p>🔑 <strong>Q2:</strong> What if I forget my password?</p>
                <p>✅ <strong>A:</strong> Click on "Forgot Password" and follow the instructions to reset it.</p>

                <!-- 2️⃣ Orders & Payments -->
                <h4 class="text-primary">2️⃣ Orders & Payments</h4>
                <p>💳 <strong>Q3:</strong> What payment methods do you accept?</p>
                <p>✅ <strong>A:</strong> We accept **M-Pesa, Credit/Debit Cards, Bank Transfers, and PayPal**.</p>

                <p>💳 <strong>Q4:</strong> How do I track my order?</p>
                <p>✅ <strong>A:</strong> Go to "My Orders" in your account dashboard to see your order status.</p>

                <!-- 3️⃣ Shipping & Delivery -->
                <h4 class="text-primary">3️⃣ Shipping & Delivery</h4>
                <p>🚚 <strong>Q5:</strong> How long does shipping take?</p>
                <p>✅ <strong>A:</strong> Standard delivery takes **2-5 business days**, depending on your location.</p>

                <p>🚚 <strong>Q6:</strong> Can I change my delivery address after placing an order?</p>
                <p>✅ <strong>A:</strong> Yes, contact support within **24 hours** of placing your order.</p>

                <!-- 4️⃣ Returns & Refunds -->
                <h4 class="text-primary">4️⃣ Returns & Refunds</h4>
                <p>🔄 <strong>Q7:</strong> What is your return policy?</p>
                <p>✅ <strong>A:</strong> You can return items within **2 days** of delivery if they are unused and in original packaging.</p>

                <p>🔄 <strong>Q8:</strong> How do I request a refund?</p>
                <p>✅ <strong>A:</strong> Initiate a refund request through your account or contact our support team.</p>

                <!-- 5️⃣ Privacy & Security -->
                <h4 class="text-primary">5️⃣ Privacy & Security</h4>
                <p>🔒 <strong>Q9:</strong> How is my personal data protected?</p>
                <p>✅ <strong>A:</strong> We comply with Kenya’s **Data Protection Act (2019)** to ensure security.</p>

                <p>🔒 <strong>Q10:</strong> Can I delete my account and personal data?</p>
                <p>✅ <strong>A:</strong> Yes, submit a request to **privacy@yourwebsite.com** for account deletion.</p>

                <!-- 📌 Contact Info -->
                <h4 class="text-primary">📌 Need More Help?</h4>
                <p>For additional questions, contact our support team:</p>
                <p>📧 Email: **{{ env('ADMIN_EMAIL') }}**</p>
                <p>📞 Phone: **{{ env('ADMIN_PHONE_NUMBER') }}**</p>
                <p>📍 Address: **{{ env('BUSINESS_ADDRESS') }}**</p>
            </div>
        </div>
    </div>
</x-layout>
